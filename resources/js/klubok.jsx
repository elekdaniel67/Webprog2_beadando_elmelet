import React, { useEffect, useState } from 'react';
import { createRoot } from 'react-dom/client';
import axios from 'axios';

axios.defaults.headers.common['X-CSRF-TOKEN'] =
    document.querySelector('meta[name="csrf-token"]').content;

axios.defaults.headers.common['Accept'] = 'application/json';

function Klubok() {
    const [klubok, setKlubok] = useState([]);
    const [csapatnev, setCsapatnev] = useState('');
    const [szerkesztettId, setSzerkesztettId] = useState(null);
    const [hiba, setHiba] = useState('');
    const [uzenet, setUzenet] = useState('');

    async function betoltes() {
        try {
            const valasz = await axios.get('/klubok');
            setKlubok(valasz.data);
            setHiba('');
        } catch {
            setHiba('Nem sikerült betölteni a klubokat.');
        }
    }

    useEffect(() => {
        betoltes();
    }, []);

    async function mentes(esemeny) {
        esemeny.preventDefault();
        setHiba('');
        setUzenet('');

        try {
            if (szerkesztettId === null) {
                await axios.post('/klubok', { csapatnev });
                setUzenet('A klubot sikeresen felvetted.');
            } else {
                await axios.put(`/klubok/${szerkesztettId}`, { csapatnev });
                setUzenet('A klubot sikeresen módosítottad.');
            }

            setCsapatnev('');
            setSzerkesztettId(null);
            await betoltes();
        } catch (error) {
            setHiba(
                error.response?.data?.errors?.csapatnev?.[0]
                ?? error.response?.data?.message
                ?? 'Nem sikerült menteni a klubot.'
            );
        }
    }

    function szerkesztes(klub) {
        setSzerkesztettId(klub.id);
        setCsapatnev(klub.csapatnev);
        setHiba('');
        setUzenet('');
    }

    function megse() {
        setSzerkesztettId(null);
        setCsapatnev('');
        setHiba('');
    }

    async function torles(klub) {
        if (!window.confirm(`Biztosan törlöd ezt a klubot: ${klub.csapatnev}?`)) {
            return;
        }

        setHiba('');
        setUzenet('');

        try {
            await axios.delete(`/klubok/${klub.id}`);

            if (szerkesztettId === klub.id) {
                megse();
            }

            setUzenet('A klubot sikeresen törölted.');
            await betoltes();
        } catch (error) {
            setHiba(
                error.response?.data?.message
                ?? 'Nem sikerült törölni a klubot.'
            );
        }
    }

    return (
        <div>
            {hiba && (
                <div role="alert" className="bg-red-800 text-white p-4 rounded mb-4">
                    {hiba}
                </div>
            )}

            {uzenet && (
                <div role="status" className="bg-green-800 text-white p-4 rounded mb-4">
                    {uzenet}
                </div>
            )}

            <form onSubmit={mentes} className="bg-gray-800 p-6 rounded-lg mb-6">
                <label htmlFor="csapatnev" className="block text-white mb-2">
                    Csapat neve
                </label>

                <input
                    id="csapatnev"
                    type="text"
                    value={csapatnev}
                    onChange={(esemeny) => setCsapatnev(esemeny.target.value)}
                    required
                    maxLength="255"
                    className="w-full rounded bg-white text-gray-900 border-gray-600 mb-4"
                />

                <div className="flex gap-3">
                    <button
                        type="submit"
                        className="bg-teal-600 hover:bg-teal-500 text-white font-semibold py-2 px-4 rounded"
                    >
                        {szerkesztettId === null ? 'Klub felvétele' : 'Módosítás mentése'}
                    </button>

                    {szerkesztettId !== null && (
                        <button
                            type="button"
                            onClick={megse}
                            className="bg-gray-700 text-white py-2 px-4 rounded"
                        >
                            Mégse
                        </button>
                    )}
                </div>
            </form>

            <div className="overflow-x-auto bg-gray-800 rounded-lg">
                <table className="min-w-full text-left text-gray-300">
                    <thead className="bg-gray-700 text-white">
                        <tr>
                            <th className="px-4 py-3">ID</th>
                            <th className="px-4 py-3">Csapat neve</th>
                            <th className="px-4 py-3">Műveletek</th>
                        </tr>
                    </thead>

                    <tbody>
                        {klubok.length === 0 ? (
                            <tr>
                                <td colSpan="3" className="px-4 py-4 text-center">
                                    Nincsenek megjeleníthető klubok.
                                </td>
                            </tr>
                        ) : (
                            klubok.map((klub) => (
                                <tr key={klub.id} className="border-t border-gray-700">
                                    <td className="px-4 py-3">{klub.id}</td>
                                    <td className="px-4 py-3">{klub.csapatnev}</td>
                                    <td className="px-4 py-3">
                                        <div className="flex gap-4">
                                            <button
                                                type="button"
                                                onClick={() => szerkesztes(klub)}
                                                className="text-teal-400 hover:text-teal-300"
                                            >
                                                Szerkesztés
                                            </button>

                                            <button
                                                type="button"
                                                onClick={() => torles(klub)}
                                                className="text-red-400 hover:text-red-300"
                                            >
                                                Törlés
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            ))
                        )}
                    </tbody>
                </table>
            </div>
        </div>
    );
}

createRoot(document.getElementById('klubok-app')).render(<Klubok />);