document.addEventListener('DOMContentLoaded', () => {
    console.log("Dark mode script loaded!");
    const themeToggle = document.getElementById('theme-toggle');
    const themeIcon = document.getElementById('theme-toggle-icon');
    const currentTheme = localStorage.getItem('theme');

    if (currentTheme === 'dark') {
        document.documentElement.classList.add('dark');
        themeIcon.textContent = '☀️';
    } else {
        themeIcon.textContent = '🌙';
    }

    themeToggle.addEventListener('click', () => {
        document.documentElement.classList.toggle('dark');
        const isDarkMode = document.documentElement.classList.contains('dark');
        localStorage.setItem('theme', isDarkMode ? 'dark' : 'light');
        themeIcon.textContent = isDarkMode ? '☀️' : '🌙';
    });
});
