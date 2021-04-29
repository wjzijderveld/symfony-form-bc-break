.PHONY: test

test:
	@echo -e "=========================\nRunning with symfony/form 5.2.3\n========================="
	@composer -q require symfony/form=5.2.3 && php test.php
	@echo -e "=========================\nRunning with symfony/form 5.2.4\n========================="
	-@composer -q require symfony/form=5.2.4 && php test.php
	@echo -e "=========================\nRunning with symfony/form 5.3.0-BETA1\n========================="
	@composer -q require symfony/form=5.3.0-BETA1 && php test.php
	@git checkout -- composer.json composer.lock && composer -q install
