module.exports = function(grunt) {

  var livereload = {
    livereload: 35729
  }

  grunt.initConfig({

    // Watches for changes and runs tasks
    // Livereload is setup for the 35729 port by default
    watch: {
      sass: {
        files: ['lib/scss/**/*.scss'],
        options: livereload
      },

      js: {
        files: ['lib/js/**/*.js'],
        options: livereload
      },

      php: {
        files: ['**/*.php'],
        options: livereload
      }
    },

  });

  // Default task
  grunt.registerTask('default', ['watch']);

  // Load up tasks
  grunt.loadNpmTasks('grunt-contrib-watch');

};