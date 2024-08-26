import React, { useState, useEffect } from "react";
import axios from "axios";
import Home from "../Home/Home";

const ConfirmarPresenca = () => {
    const [jogadores, setJogadores] = useState([]);
    const [presenca, setPresenca] = useState([]);
    const [mensagem, setMensagem] = useState("");

    useEffect(() => {
        // Função para carregar a lista de jogadores
        const loadJogadores = async () => {
            try {
                const response = await axios.get("api/players");
                setJogadores(response.data.jogadores);
            } catch (err) {
                setMensagem(
                    "Erro ao carregar jogadores. Verifique o console para mais detalhes."
                );
                console.error(err);
            }
        };

        loadJogadores();
    }, []);

    const handleConfirmarPresenca = async () => {
        try {
            await axios.post(
                "/api/players",
                { presenca },
                {
                    headers: {
                        "Content-Type": "application/json",
                    },
                }
            );
            setMensagem("Presença confirmada com sucesso!");
        } catch (err) {
            setMensagem(
                "Erro ao confirmar presença. Verifique o console para mais detalhes."
            );
            console.error(err);
        }
    };

    const handleChange = (jogadorId) => {
        setPresenca((prevPresenca) =>
            prevPresenca.includes(jogadorId)
                ? prevPresenca.filter((id) => id !== jogadorId)
                : [...prevPresenca, jogadorId]
        );
    };

    return (
        <>
            <Home />
            <div>
                <h1>Confirmar Presença</h1>
                {jogadores.length === 0 ? (
                    <p>Carregando jogadores...</p>
                ) : (
                    <form onSubmit={(e) => e.preventDefault()}>
                        {jogadores.map((jogador) => (
                            <div key={jogador.id}>
                                <label>
                                    <input
                                        type="checkbox"
                                        checked={presenca.includes(jogador.id)}
                                        onChange={() =>
                                            handleChange(jogador.id)
                                        }
                                    />
                                    {jogador.nome}
                                </label>
                            </div>
                        ))}
                        <button type="button" onClick={handleConfirmarPresenca}>
                            Confirmar Presença
                        </button>
                    </form>
                )}
                {mensagem && <p>{mensagem}</p>}
            </div>
        </>
    );
};

export default ConfirmarPresenca;
