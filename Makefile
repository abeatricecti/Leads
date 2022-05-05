
.PHONY: help
help: ## This help
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

null:
	help

# Makefile Command Line Arguments!
ARGS = `arg="$(filter-out $@,$(MAKECMDGOALS))" && echo $${arg:-${1}}`

COMPOSER := docker run -it --rm \
    -v `pwd`:/opt \
    -w /opt laravelsail/php81-composer:latest composer

.PHONY: build
build: ## Build the entire app
	@$(COMPOSER) install && \
	cp .env.example .env && \
	./vendor/bin/sail up

.PHONY: sail
sail: ## sail cli
	./vendor/bin/sail $(ARGS)
