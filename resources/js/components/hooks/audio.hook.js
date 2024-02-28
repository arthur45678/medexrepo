import { useCallback, useEffect } from "react";

export const useAudio = () => {
    const keyInStorage = "tabKey";
    const tabKey = Math.random() * 10000; // A random key for current tab

    const playNotificationSound = useCallback(() => {
        if (localStorage.getItem(keyInStorage) != tabKey) return false;

        const audio = document.getElementById("notification-audio");

        audio.muted = false;
        audio.play();
    }, []);

    useEffect(() => {
        localStorage.setItem(keyInStorage, tabKey); // Change localStorage value so that tabKey only works for this particular tab
    }, []);

    return { playNotificationSound };
};
