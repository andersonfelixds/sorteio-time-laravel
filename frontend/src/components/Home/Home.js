import React from "react";
import { Link } from "react-router-dom";
import "./styles.css";
const Home = () => {
    return (
        <div>
            <nav>
                <ul>
                    <li>
                        <Link to="/">Home</Link>
                    </li>
                    <li>
                        <Link to="/cadastro">Cadastro de Jogadores</Link>
                    </li>
                    <li>
                        <Link to="/confirma">Confirmar Presença</Link>
                    </li>
                    <li>
                        <Link to="/sorteio">Sorteio</Link>
                    </li>
                </ul>
            </nav>
        </div>
    );
};

export default Home;
