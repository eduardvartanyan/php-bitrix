document.addEventListener('DOMContentLoaded', () => {
    const scriptUrl = `${BX.message('TEMPLATE_FOLDER')}/js/keyboard.js`;
    const existing = document.querySelector(`script[src="${scriptUrl}"]`);

    if (existing) return;

    const script = document.createElement('script');
    script.src = scriptUrl;
    script.onload = () => {
        try {
            const keyboard = new KsoKeyboard();
            keyboard.init();
        } catch (e) {
            console.error('Keyboard init error:', e);
        }
    };
    script.onerror = (e) => {
        console.error('keyboard.js load error:', e);
    };

    document.head.appendChild(script);
});
