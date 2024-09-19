new Vue({
  el: '#app',
  data() {
    return {
      outputs: [], // Array to store command outputs
      confirmRestart: false
    };
  },
  methods: {
    RestartRouter() {
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        reverseButtons: true,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, restart router!'
      }).then((result) => {
        if (result.isConfirmed) {
          this.getRestartRouter();
        }
      });
    },
    getRestartRouter() {
      axios.post('api.php', {
        action: 'restartRouter'
      })
        .then(response => {
          console.log(response.data);
          Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Router has been restarted!',
            showConfirmButton: false,
            timer: 1500
          });
        })
        .catch(error => {
          console.error(error);
          Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Failed to restart router!',
            showConfirmButton: false,
            timer: 1500
          });
        });
    },
    RestartOc() {
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        reverseButtons: true,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, restart Openclash!'
      }).then((result) => {
        if (result.isConfirmed) {
          this.getRestartOc();
        }
      });
    },
    getRestartOc() {
      axios.post('api.php', {
        action: 'restartOpenclash'
      })
        .then(response => {
          console.log(response.data);
          Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Openclash has been restarted!',
            showConfirmButton: false,
            timer: 1500
          });
        })
        .catch(error => {
          console.error(error);
          Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Failed to restart Openclash!',
            showConfirmButton: false,
            timer: 1500
          });
        });
    }
  }
});
