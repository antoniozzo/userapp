module.exports = function (grunt) {

	grunt.initConfig({

        pkg: grunt.file.readJSON('package.json'),

		options: {

			publish: 'webroot',
			assets: '<%= options.publish %>/assets',

			clean: {
				all: ['<%= options.css.concat %>', '<%= options.css.min %>', '<%= options.less.compiled %>', '<%= options.js.min %>', '<%= options.js.concat %>'],
				concat: ['<%= options.css.concat %>', '<%= options.js.concat %>', '<%= options.publish %>/sprites.css']
			},

			css: {
				base: '<%= options.assets %>/css',
				files: ['<%= options.publish %>/sprites.css', '<%= options.css.base %>/styles.css'],
				concat: '<%= options.css.base %>/concat.css',
				min: '<%= options.publish %>/styles.min.css'
			},

			js: {
				base: '<%= options.assets %>/js',
				files: ['<%= options.js.base %>/modernizr.min.js', '<%= options.js.base %>/scripts.js'],
				concat: '<%= options.js.base %>/concat.js',
				min: '<%= options.publish %>/scripts.min.js'
			},

			less: {
				base: '<%= options.assets %>/less',
				file: '<%= options.less.base %>/styles.less',
				compiled: '<%= options.css.base %>/styles.css'
			},

			legacssy: {
				file: '<%= options.publish %>/styles.min.css',
				compiled: '<%= options.publish %>/styles.ie.css'
			},

			php: {
				files: ['Controller/*.php', 'Model/*.php', 'Test/Case/Controller/*.php', 'Test/Case/Model/*.php'],
			},

			svg: {
				dir: '<%= options.assets %>/img/svg',
				files: ['<%= options.svg.dir %>/*.svg'],
				min: '<%= options.assets %>/img/sprites',
				css: '<%= options.publish %>'
			}
		},

		clean: {
			all: {
				src: '<%= options.clean.all %>'
			},
			concat: {
				src: '<%= options.clean.concat %>'
			}
		},

		concat: {
			css: {
				files: {
					'<%= options.css.concat %>' : ['<%= options.css.files %>']
				}
			},
			js: {
				options: {
					block: true,
					line: true,
					stripBanners: true
				},
				files: {
					'<%= options.js.concat %>' : ['<%= options.js.files %>'],
				}
			}
		},

		cssmin: {
			minify: {
	       		src: '<%= options.css.concat %>',
	        	dest: '<%= options.css.min %>'
			}
		},

		jshint: {
			files: ['<%= options.js.files %>'],
			options: {
				curly: true,
				indent: 4,
				trailing: true,
				devel: true,
				globals: {
					jQuery: true
				}
			}
		},

		less: {
			main: {
				options: {
					yuicompress: true,
					ieCompat: true
				},
				files: {
					'<%= options.less.compiled %>': '<%= options.less.file %>'
				}
			}
		},

		uglify: {
			options: {
				preserveComments: false
			},
			files: {
				src: '<%= options.js.concat %>',
				dest: '<%= options.js.min %>'
			}
		},

		shell: {
			test: {
	            options: {
	                stdout: true
	            },
	            command: './Console/cake test app all'
	        }
        },

		'svg-sprites': {
			options: {
				paths: {
					spriteElements: '<%= options.svg.dir %>',
					sprites: '<%= options.svg.min %>',
					css: '<%= options.svg.css %>',
				},
				sizes: {
					large: 30,
					medium: 25,
					small: 20
				},
				refSize: 30
			}
		},

		legacssy: {
            ie8: {
                files: {
                    '<%= options.legacssy.compiled %>': ['<%= options.legacssy.file %>'],
                }
            }
        },

		watch: {
			scripts: {
				files: ['<%= options.svg.files %>', '<%= options.js.files %>', '<%= options.less.base %>/*.less', '!<%= options.js.min %>', '!<%= options.less.compiled %>'],
				tasks: ['scripts']
			},
			tests: {
                files: ['<%= options.php.files %>'],
                tasks: ['shell:test']
            }
		}

	});

	grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.loadNpmTasks('grunt-contrib-compress');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-shell');
	grunt.loadNpmTasks('dr-grunt-svg-sprites');
	grunt.loadNpmTasks('grunt-legacssy');

	grunt.registerTask('default', 'watch');
	grunt.registerTask('scripts', ['clean:all', 'svg-sprites', 'less', 'concat:css', 'concat:js', 'cssmin', 'legacssy', 'uglify', 'clean:concat']);
}