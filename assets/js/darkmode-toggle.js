document.addEventListener('DOMContentLoaded', () => {
    const themeToggle = document.getElementById('theme-toggle');
    const icon = themeToggle.querySelector('i');
    const text = themeToggle.querySelector('span');
    
    // Function to update button appearance
    const updateButton = (isDark) => {
      icon.className = isDark ? 'bi bi-moon' : 'bi bi-sun';
      text.textContent = isDark ? 'Dark' : 'Light';
    };
    
    // Function to set theme
    const setTheme = (isDark) => {
      document.body.setAttribute('data-bs-theme', isDark ? 'dark' : 'light');
      updateButton(isDark);
      
      // Set cookie with 30 days expiration
      const expirationDate = new Date();
      expirationDate.setDate(expirationDate.getDate() + 30);
      document.cookie = `theme=${isDark ? 'dark' : 'light'}; expires=${expirationDate.toUTCString()}; path=/; SameSite=Strict`;
    };
    
    // Initialize from cookie if exists
    const themeCookie = document.cookie
      .split('; ')
      .find(row => row.startsWith('theme='));
    
    if (themeCookie) {
      const savedTheme = themeCookie.split('=')[1];
      setTheme(savedTheme === 'dark');
    }
    
    // Toggle handler
    themeToggle.addEventListener('click', () => {
      const currentTheme = document.body.getAttribute('data-bs-theme');
      setTheme(currentTheme === 'light');
    });
  });
