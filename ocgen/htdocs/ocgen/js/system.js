const app = new Vue({
  el: "#app",
  data() {
    return {
      username: "",
      password: "",
      password_confirmation: "",
      theme: "light"
    }
  },
  computed: {
    status() {
      return (this.password === this.password_confirmation) && (this.password_confirmation.trim().length > 0)
    }
  },
  methods: {
    getSystemConfig() {
      return new Promise((resolve) => {
        axios.post('api.php', {
          action: "get_system_config"
        }).then((res) => {
          resolve(res.data.data)
        })
      })
    },
    changePassword() {
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, change password!'
      }).then((result) => {
        if (result.isConfirmed) {
          axios.post('api.php', {
            action: "change_password",
            password: this.password_confirmation
          }).then(() => {
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'Password has been changed!',
              showConfirmButton: false,
              timer: 1500
            })
            this.password = ""
            this.password_confirmation = ""
          })
        }
      })
    },
    changeTheme() { // with dialog
      Swal.fire({
        title: 'Change Theme',
        text: 'Are you sure you want to change the theme?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, change theme!'
      }).then((result) => {
        if (result.isConfirmed) {
          const themeSelect = document.getElementById('theme-select');
          const selectedTheme = themeSelect.value;

          this.theme = selectedTheme; // Menyimpan nilai tema ke properti theme dalam objek Vue.js

          axios.post('api.php', {
            action: "change_theme",
            theme: this.theme
          }).then(() => {
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'Theme has been changed!',
              showConfirmButton: false,
              timer: 1500
            }).then(() => {
              this.applyTheme();
              this.saveThemeToCookie(this.theme);
              // Refresh halaman
              location.reload();
            });
          }).catch(() => {
            Swal.fire({
              position: 'center',
              icon: 'error',
              title: 'Failed to save theme',
              showConfirmButton: false,
              timer: 1500
            });
          });
        }
      });
    },
    applyTheme() {
      const body = document.querySelector('body');
      const sunAstro = document.querySelector('.sun.astro-KXYEDVG6');
      const moonAstro = document.querySelector('.moon.astro-KXYEDVG6');

      body.classList.remove('dark', 'light');
      body.classList.add(this.theme);

      if (this.theme === 'dark') {
        sunAstro.style.display = 'none';
        moonAstro.style.display = 'block';
      } else {
        sunAstro.style.display = 'block';
        moonAstro.style.display = 'none';
      }
    },
    saveThemeToCookie(theme) {
      document.cookie = `theme=${theme}; path=/`;
    },
    saveTheme() { // without dialog
      const themeSelect = document.getElementById('theme-select');
      const selectedTheme = themeSelect.value;

      this.theme = selectedTheme; // Menyimpan nilai tema ke properti theme dalam objek Vue.js

      axios.post('api.php', {
        action: "change_theme",
        theme: this.theme
      }).then(() => {
        Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Theme has been changed!',
          showConfirmButton: false,
          timer: 1500
        }).then(() => {
          this.applyTheme();
          this.saveThemeToCookie(this.theme);
          // Refresh halaman
          location.reload();
        });
      }).catch(() => {
        Swal.fire({
          position: 'center',
          icon: 'error',
          title: 'Failed to save theme',
          showConfirmButton: false,
          timer: 1500
        });
      });
    }
  },
  created() {
    this.getSystemConfig().then((res) => {
      this.username = res.system.username;
      this.theme = res.system.theme; // Menetapkan tema awal dari sistem konfigurasi
      this.applyTheme();
    })
  }
});
