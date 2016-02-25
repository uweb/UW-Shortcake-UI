module.exports = function( grunt ) {

	'use strict';
	var banner = '/**\n * <%= pkg.homepage %>\n * Copyright (c) <%= grunt.template.today("yyyy") %>\n * This file is generated automatically. Do not edit.\n */\n';
	// Project configuration
	grunt.initConfig( {

		pkg:    grunt.file.readJSON( 'package.json' ),

		// addtextdomain: {
		// 	options: {
		// 		textdomain: 'shortcake-bakery',
		// 	},
		// 	target: {
		// 		files: {
		// 			src: [ '*.php', '**/*.php', '!node_modules/**', '!php-tests/**', '!bin/**' ]
		// 		}
		// 	}
		// },

		// wp_readme_to_markdown: {
		// 	your_target: {
		// 		files: {
		// 			'README.md': 'readme.txt'
		// 		}
		// 	},
		// },

		// phpcs: {
		// 	plugin: {
		// 		src: './'
		// 	},
		// 	options: {
		// 		bin: "vendor/bin/phpcs --extensions=php --ignore=\"*/vendor/*,*/node_modules/*\"",
		// 		standard: "phpcs.ruleset.xml"
		// 	}
		// },

		notify: {
	      watch: {
	        options: {
	          title: 'Dun\' Grunted',
	          message: 'All is good'
	        }
	      }
	    },
	    less: {
	        production: {
		        options: {
			        cleancss: true
				},
				files: {
					//'css/admin.uw-module.css': 'less/admin.uw-module.less',
	        		'assets/css/uw-module.css'      : 'assets/less/uw-module.less'
				}
			},
			development: {
				files: {
					//'css/admin.uw-module.dev.css': 'less/admin.uw-module.less',
	        		'assets/css/uw-module.dev.css'      : 'assets/less/uw-module.less'
				}
			}
		},

		watch: {
			// dev: {
			// 	files: [ '*.php' ],
			// 	tasks: [ 'phpcs' ]
			// },
			css: {
		        files: ['assets/less/*.less'],
		        tasks: ['css']
		      }
		},

		// makepot: {
		// 	target: {
		// 		options: {
		// 			domainPath: '/languages',
		// 			mainFile: 'shortcake-bakery.php',
		// 			potFilename: 'shortcake-bakery.pot',
		// 			potHeaders: {
		// 				poedit: true,
		// 				'x-poedit-keywordslist': true
		// 			},
		// 			type: 'wp-plugin',
		// 			updateTimestamp: true
		// 		}
		// 	}
		// },
	} );

	grunt.loadNpmTasks('grunt-notify');
  	grunt.loadNpmTasks('grunt-contrib-less');
	//grunt.loadNpmTasks( 'grunt-wp-i18n' );
	//grunt.loadNpmTasks( 'grunt-wp-readme-to-markdown' );
	//grunt.loadNpmTasks( 'grunt-phpcs' );
	grunt.loadNpmTasks( 'grunt-contrib-watch' );

	grunt.registerTask('default', ['notify', 'less']);
	//grunt.registerTask( 'i18n', ['addtextdomain', 'makepot'] );
	//grunt.registerTask( 'readme', ['wp_readme_to_markdown']);
	grunt.registerTask( 'css', ['less', 'notify'] );


	grunt.util.linefeed = '\n';

};
