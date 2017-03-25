default: help

help:
	@echo "Allowed operations:"

	@echo "\nTesting:"
	@echo " - phpunit               // Run PHPUnit tests"
	@echo " - behat                 // Run Behat tests"
	@echo " - coverage              // Run tests and get code coverage report"

	@echo "\nUtilities:"
	@echo " - phpmd                 // PHP Mess Detector"
	@echo " - phpcs                 // PHP Code Sniffer"
	@echo " - php7cc                // Checks PHP 5.3 - 5.6 code for compatibility with PHP7"

check: phpcs phpmd check-deprecations

test: phpunit behat

behat: rm-cache
	bin/behat --stop-on-failure

phpunit:
	bin/phpunit

phpunit-coverage:
	SYMFONY_DEPRECATIONS_HELPER=weak bin/phpunit -c app --testsuite UnitTest --coverage-php build/code-coverage/phpunit.cov

behat-coverage: rm-cache
	BEHAT_COVERAGE=true bin/behat --format progress

phpcov:
	bin/phpcov merge --html build/code-coverage/report build/code-coverage

coverage: fixtures phpunit-coverage behat-coverage phpcov

phpmd:
	bin/phpmd src/ xml vendor/creolink/code_style/phpmd-ruleset.xml --reportfile build/phpmd.xml --suffixes php --exclude Resources,Tests

phpcs:
	phpcs --ignore=fixtures --standard=vendor/creolink/code_style/Symfony2 module

php7cc:
	bin/php7cc --except=vendor app/ src/ --verbose

phplint:
	find app/ src/ -name "*.php" ! -path "*cache*" ! -path "*Test*" -print0 -exec php -l {} 2>&1 > /dev/null \;

rm-cache:
	rm -fR data/cache/*
