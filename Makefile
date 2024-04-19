# .PHONY: help

# # help:
# # 	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'


install: ## Install all
	npm install 

rebuild: ## Rebuild database
	symfony console d:d:drop -f
	symfony console d:d:create
	symfony console d:s:u --force
	symfony console d:f:l 