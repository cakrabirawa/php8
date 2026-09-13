<div
    x-data="{
        theme: localStorage.getItem('d365-theme') ?? (document.documentElement.classList.contains('dark') ? 'dark' : 'light'),
        setTheme(value) {
            this.theme = value;
            localStorage.setItem('d365-theme', value);
            localStorage.setItem('theme', value);
            document.documentElement.classList.toggle('dark', value === 'dark');
        }
    }"
    x-init="setTheme(theme)"
    style="display: flex; align-items: center; justify-content: flex-end; height: 100%;"
>
    <span
        x-text="theme === 'dark' ? 'Dark mode' : 'Light mode'"
        style="margin-right: 0.75rem; font-size: 0.75rem; color: #9ca3af;"
    ></span>
    <button
        type="button"
        x-on:click="setTheme(theme === 'dark' ? 'light' : 'dark')"
        x-bind:aria-label="theme === 'dark' ? 'Gunakan tema terang' : 'Gunakan tema gelap'"
        x-bind:style="theme === 'dark' ? 'display: inline-flex; width: 44px; height: 24px; align-items: center; padding: 0; border: 0; border-radius: 9999px; background: #059669; cursor: pointer; transition: background-color 250ms ease;' : 'display: inline-flex; width: 44px; height: 24px; align-items: center; padding: 0; border: 0; border-radius: 9999px; background: #9ca3af; cursor: pointer; transition: background-color 250ms ease;'"
    >
        <span
            x-bind:style="theme === 'dark' ? 'display: block; width: 16px; height: 16px; margin-left: 24px; border-radius: 9999px; background: #ffffff; box-shadow: 0 1px 3px rgb(0 0 0 / 25%); transition: margin-left 250ms ease;' : 'display: block; width: 16px; height: 16px; margin-left: 4px; border-radius: 9999px; background: #ffffff; box-shadow: 0 1px 3px rgb(0 0 0 / 25%); transition: margin-left 250ms ease;'"
        ></span>
    </button>
</div>
