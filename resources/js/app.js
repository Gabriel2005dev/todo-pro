import Alpine from 'alpinejs'

window.Alpine = Alpine

Alpine.store('theme', {
    darkMode: false,

    init() {
        const saved = localStorage.getItem('theme')

        if (saved === 'dark') this.darkMode = true
        else if (saved === 'light') this.darkMode = false
        else {
            this.darkMode = window.matchMedia('(prefers-color-scheme: dark)').matches
        }

        this.apply()
    },

    toggle() {
        this.darkMode = !this.darkMode
        localStorage.setItem('theme', this.darkMode ? 'dark' : 'light')
        this.apply()
    },

    apply() {
        if (this.darkMode) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    }
})

Alpine.start()