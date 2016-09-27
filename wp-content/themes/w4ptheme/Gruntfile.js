module.exports = function (grunt) {

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    sass: {
      options: {
        outputStyle: 'compressed',
        sourceMap: true
      },
      all: {
        options: {
          includePaths: [
          ]
        },
        files: {
          'css/application.css': 'scss/application.scss'
        }
      }
    },

    postcss: {
      options: {
        map: true,
        processors: [
          require('autoprefixer-core')({
            browsers: ['> 0.5%', 'last 2 versions', 'Firefox ESR', 'Opera 12.1', 'ie >6']
          })
        ]
      },
      all: {
        src: 'css/*.css'
      }
    },

    uglify: {
      options: {
        sourceMap: true
      },
      vendor: {
        files: {
          'js/vendor.min.js': [
            'bower_components/jquery/dist/jquery.min.js',
            'js/vendor/jquery-ui.min.js',
            'js/vendor/jquery.selectBoxIt.min.js'
          ]
        }
      },
      custom: {
        files: {
          'js/app.min.js': [
            'js/custom/svgdefs.js',
            'js/custom/app.js'
          ]
        }
      }
    },

    imagemin: {
      all: {
        files: [{
          expand: true,
          cwd: 'images/',
          src: ['**/*.{png,jpg,gif}'],
          dest: 'images/'
        }]
      }
    },

    svgstore: {
      options: {
        cleanupdefs: true
      },
      default: {
        files: {
          'images/defs.svg': ['images/svgs/*.svg']
        }
      }
    },

    svginjector: {
      svgdefs: {
        options: {
          container: '#svgPlaceholder'
        },
        files: {
          'js/custom/svgdefs.js': 'images/defs.svg'
        }
      }
    },

    watch: {
      sass: {
        files: 'scss/**/*.scss',
        tasks: ['sass', 'postcss']
      },
      jsVendor: {
        files: 'js/vendor/**/*.js',
        tasks: ['uglify:vendor']
      },
      jsCustom: {
        files: 'js/custom/**/*.js',
        tasks: ['uglify:custom']
      },
      svg: {
        files: 'images/svgs/*.svg',
        tasks: ['svgstore', 'svginjector']
      }
    }
  });

  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-postcss');
  grunt.loadNpmTasks('grunt-contrib-imagemin');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-svgstore');
  grunt.loadNpmTasks('grunt-svginjector');

  grunt.registerTask('default', ['sass', 'postcss', 'imagemin', 'svgstore', 'svginjector', 'uglify']);

};
