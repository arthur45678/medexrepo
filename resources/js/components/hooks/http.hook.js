import { useState, useCallback } from "react";

export const useHttp = () => {
    const [error, setError] = useState(null);
    const [loading, setLoading] = useState(false);

    const request = useCallback(
        async (url, method = "GET", body = null, headers = {}) => {
            setLoading(true);

            try {
                if (body) {
                    body = JSON.stringify(body);
                    headers["Content-Type"] = "application/json";
                }
                headers["X-CSRF-TOKEN"] = document
                    .querySelector("meta[name=csrf-token]")
                    .getAttribute("content");
                headers["X-Requested-With"] = "XMLHttpRequest";

                const response = await fetch(url, { method, body, headers });
                const data = await response.json();

                if (!response.ok) {
                    throw new Error(data.message || "Error");
                }

                setLoading(false);
                return data;
            } catch (e) {
                setLoading(false);
                setError(e.message);
            }
        },
        []
    );

    const clearError = useCallback(() => setError(null), []);

    return { loading, error, request, clearError };
};
