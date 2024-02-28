import React, { useState, useEffect, useCallback } from "react";
import ReactDOM from "react-dom";
import { useHttp } from "./hooks/http.hook";
import { useAudio } from "./hooks/audio.hook";

const Referral = ({ referral }) => {
    const isNew = referral.opened_at === null,
        textClassName = `text-truncate ${isNew && "font-weight-bold"}`;

    return (
        <a
            className={`dropdown-item ${isNew || "dropdown-item-not-opened"}`}
            href={`/referrals/patients/received/${referral.id}`}
        >
            <div className="message">
                <div className="py-3 mfe-3 float-left"></div>
                <div className={textClassName}>
                    {referral.sender.department.name}
                </div>
                <div className={textClassName}>{referral.sender.full_name}</div>
                <div className="small text-muted float-right">
                    {referral.date_with_diff}
                </div>
            </div>
        </a>
    );
};

const ReceivedReferrals = () => {
    const [referrals, setReferrals] = useState([]);
    const [unopenedReferralsCount, setUnopenedReferralsCount] = useState([]);

    const { request, loading } = useHttp();
    const { playNotificationSound } = useAudio();

    const loadReferrals = useCallback(async () => {
        try {
            const response = await request("/referrals/patients/received");
            setReferrals(response.receivedReferrals);
            setUnopenedReferralsCount(response.unopenedReferralsCount);
        } catch (error) {}
    }, []);

    useEffect(() => {
        loadReferrals();
    }, [loadReferrals]);

    useEffect(() => {
        try {
            window.Echo.private("App.User." + window.Laravel.user.id).listen(
                "ReferralReceivedEvent",
                ({ referral }) => {
                    setReferrals([referral, ...referrals]);
                    setUnopenedReferralsCount(unopenedReferralsCount + 1);
                    playNotificationSound();
                }
            );
        } catch (e) {}
    }, [
        referrals,
        unopenedReferralsCount,
        setReferrals,
        setUnopenedReferralsCount,
        playNotificationSound
    ]);

    if (loading)
        return (
            <div className="d-flex justify-center">
                <span className="spinner spinner-border"></span>
            </div>
        );

    const renderedReferrals = referrals.map(r => (
        <Referral referral={r} key={r.id} />
    ));

    return (
        <>
            <a
                className={`c-header-nav-link ${
                    unopenedReferralsCount > 0 ? "pulse" : ""
                }`}
                data-toggle="dropdown"
                href="#"
                role="button"
                aria-haspopup="true"
                aria-expanded="false"
            >
                <svg className="c-icon">
                    <use xlinkHref="/assets/icons/coreui/free-symbol-defs.svg#cui-cloud-download"></use>
                </svg>
                <span className="badge badge-danger">
                    {unopenedReferralsCount}
                </span>
            </a>
            <div className="dropdown-menu dropdown-menu-right dropdown-menu-lg dropdown-limited pt-0">
                <div className="dropdown-header">
                    <strong onClick={playNotificationSound}>
                        Ստացված է {unopenedReferralsCount} նոր ուղեգիր
                    </strong>
                </div>

                {renderedReferrals}

                <a
                    className="dropdown-item text-center border-top"
                    href="/referrals/patients/received"
                >
                    <strong>Բոլորը</strong>
                </a>
            </div>
        </>
    );
};

export default ReceivedReferrals;

const element = document.getElementById("received-referrals");

if (element) {
    // const props = Object.assign({}, element.dataset);
    ReactDOM.render(<ReceivedReferrals />, element);
}
