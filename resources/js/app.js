import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.content-body pre').forEach((pre) => {
        if (pre.querySelector('.code-copy-btn')) {
            return;
        }

        const button = document.createElement('button');
        button.type = 'button';
        button.className = 'code-copy-btn';
        button.textContent = 'Copy';

        button.addEventListener('click', async () => {
            const codeEl = pre.querySelector('code');
            const textToCopy = codeEl ? codeEl.innerText : pre.innerText;

            try {
                await navigator.clipboard.writeText(textToCopy);
                button.textContent = 'Copied';
            } catch (error) {
                const textarea = document.createElement('textarea');
                textarea.value = textToCopy;
                textarea.setAttribute('readonly', '');
                textarea.style.position = 'absolute';
                textarea.style.left = '-9999px';
                document.body.appendChild(textarea);
                textarea.select();
                document.execCommand('copy');
                document.body.removeChild(textarea);
                button.textContent = 'Copied';
            }

            setTimeout(() => {
                button.textContent = 'Copy';
            }, 1200);
        });

        pre.appendChild(button);
    });
});
