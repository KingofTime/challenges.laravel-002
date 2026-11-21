up:
	./vendor/bin/sail up -d

down:
	./vendor/bin/sail down

test:
	./vendor/bin/sail artisan test --env=testing

lint:
	./vendor/bin/sail pint
