import React, { useState } from "react";
import ReactDOM from "react-dom";

const List = ({ items = "[]" }) => {
    const [search, setSearch] = useState("");

    // const items = ["hello", "world", "document", "new document"];

    const listItems = JSON.parse(items)
        .filter(i => i.includes(search))
        .map((item, i) => (
            <li className="c-sidebar-nav-item" key={i}>
                <a
                    className="c-sidebar-nav-link"
                    href="/buttons/buttons"
                    rel="noopener noreferrer"
                >
                    {item}
                </a>
            </li>
        ));

    return (
        <>
            <li className="c-sidebar-nav-item">
                <input
                    type="search"
                    className="form-control"
                    placeholder="Որոնում․․․"
                    value={search}
                    onChange={e => setSearch(e.target.value)}
                />
            </li>
            {listItems}
        </>
    );
};

export default List;

const element = document.getElementById("list");

if (element) {
    const props = Object.assign({}, element.dataset);
    // console.log({ ...props });
    ReactDOM.render(<List {...props} />, element);
}
