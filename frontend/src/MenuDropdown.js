import React from "react";
import { Link } from "react-router-dom";

function MenuDropdown() {
    return (
        <div className="menu">
            <ul>
                <li>
                    <Link to="/">Página Inicial</Link>
                </li>
                <li>
                    <Link to="/sobre">Sobre</Link>
                </li>
                <li>
                    <Link to="/contato">Contato</Link>
                </li>
            </ul>
        </div>
    );
}

export default MenuDropdown;
