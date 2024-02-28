import React, { useCallback, useState } from "react";
import ReactDOM from "react-dom";

import AsyncSelect from "react-select/async";

import { useHttp } from "./hooks/http.hook";

export const Select = ({
    name = "",
    catalogName = "diseases",
    oldValue = ""
}) => {
    if (!name)
        throw new Error("The data-name attribute must be set correctly.");

    const [search, setSearch] = useState(oldValue);

    const { request } = useHttp();

    const loadOptions = useCallback(async () => {
        try {
            if (search.length < 2) return false;

            const req = await request(
                `/catalogs/${catalogName}.json?q=${search}`,
                "get"
            );

            return req;
        } catch (e) {}
    }, [search]);

    const handleChange = newValue => {
        setSearch(newValue);
        return newValue;
    };

    const renderInput = props => {
        return <input {...props} value={search} />;
    };

    return (
        <AsyncSelect
            name={name}
            onBlurResetsInput={false}
            onCloseResetsInput={false}
            // inputValue={search}
            inputRenderer={renderInput}
            cacheOptions
            onInputChange={handleChange}
            loadOptions={loadOptions}
        />
    );
};

export default Select;

const elements = document.querySelectorAll(".react-select-container");

if (elements.length) {
    elements.forEach(element => {
        const props = element.dataset; // data-name, data-catalog-name and other data-attributes
        ReactDOM.render(<Select {...props} />, element);
    });
}
