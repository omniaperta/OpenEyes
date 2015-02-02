class core::wkhtmltox {
	exec { "download_wkhtmltox":
		cwd => '/tmp',
		command => "/usr/bin/curl -L http://downloads.sourceforge.net/project/wkhtmltopdf/0.12.2.1/wkhtmltox-0.12.2.1_linux-precise-amd64.deb -o wkhtmltox.deb",
		creates => "/tmp/wkhtmltox.deb",
		require => Package['curl']
	}
        package { 'xfonts-75dpi':
                ensure  => present,
                require => Exec['apt-update']
        }
        package { 'xfonts-base':
                ensure  => present,
                require => Package['xfonts-75dpi']
        }
	package { "wkhtmltox":
		provider => dpkg,
		ensure => installed,
		source => "/tmp/wkhtmltox.deb",
		require => [
			Package['xfonts-base'],
			Exec["download_wkhtmltox"]
		]
	}
}
