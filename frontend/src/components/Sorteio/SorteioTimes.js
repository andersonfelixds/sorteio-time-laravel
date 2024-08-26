import React, { useState } from "react";
import axios from "axios";
import Home from "../Home/Home";

const SorteioTimes = () => {
    const [numeroDeJogadores, setNumeroDeJogadores] = useState(5);
    const [times, setTimes] = useState([]);
    const [error, setError] = useState("");

    const sortearTimes = async () => {
        try {
            axios.defaults.withCredentials = true;
            setError("");
            const response = await axios.post(
                "http://app:8989/api/sortear-times",
                {
                    numero_de_jogadores_por_time: numeroDeJogadores,
                },
                {
                    headers: {
                        "Content-Type": "application/json", // Define a política de referer se necessário
                    },
                }
            );
            setTimes(response.data.times);
        } catch (err) {
            setError(
                "Erro ao sortear os times. Verifique o console para mais detalhes."
            );
            console.error(err);
        }
    };
    console.log(times);
    return (
        <>
            <Home />
            <div>
                <h1>Sorteio de Times</h1>
                <input
                    type="number"
                    value={numeroDeJogadores}
                    onChange={(e) => setNumeroDeJogadores(e.target.value)}
                    min="1"
                    placeholder="Número de jogadores por time"
                />
                <button onClick={sortearTimes}>Sortear Times</button>
                {error && <p style={{ color: "red" }}>{error}</p>}
                {times && (
                    <div>
                        {Object.entries(times).map(([timeIndex, time]) => (
                            <div key={timeIndex}>
                                <h2>Time {timeIndex}</h2>
                                <h3>Goleiro:</h3>
                                {time.goleiro ? (
                                    <p>{time.goleiro.nome}</p>
                                ) : (
                                    <p>Nenhum goleiro disponível</p>
                                )}
                                <h3>Jogadores:</h3>
                                {time.jogadores.length > 0 ? (
                                    <ul>
                                        {time.jogadores.map(
                                            (jogador, index) => (
                                                <li key={index}>
                                                    {jogador.name}
                                                </li>
                                            )
                                        )}
                                    </ul>
                                ) : (
                                    <p>Nenhum jogador disponível</p>
                                )}
                            </div>
                        ))}
                    </div>
                )}
            </div>
        </>
    );
};

export default SorteioTimes;
