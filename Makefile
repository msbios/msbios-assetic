TAG := 1.0

ifndef TAG
$(error The TAG variable is missing.)
endif

ENV := dev

ifndef ENV
$(error The ENV variable is missing.)
endif
 
ifeq ($(filter $(ENV),test dev stag prod),)
$(error The ENV variable is invalid.)
endif
 
ifeq (,$(filter $(ENV),test dev))
COMPOSE_FILE_PATH := -f docker-compose.yml
endif

IMAGE := msbios/portal

help: ## Outputs this help screen
	@grep -E '(^[a-zA-Z0-9_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

build: ## Build or rebuild services without cache when building the image
	$(info Make: Building "$(ENV)" environment images.)
	@TAG=$(TAG) docker-compose build --no-cache
	@make -s clean

start: ## Builds, (re)creates, starts, and attaches to containers for a service in the background
	$(info Make: Starting "$(ENV)" environment containers.)
	@TAG=$(TAG) docker-compose $(COMPOSE_FILE_PATH) up -d

stop: ## Stop running containers without removing them
	$(info Make: Stopping "$(ENV)" environment containers.)
	@docker-compose stop

down: ## Stops containers and removes containers, networks, volumes, and images created by `up`
	$(info Make: Stopping and removing "$(ENV)" environment containers, networks, and volumes.)
	@docker-compose down --remove-orphans

clear: ## Stops containers and removes containers, networks, volumes with static informations
	$(info Make: Stopping and removing "$(ENV)" environment containers, networks, and volumes with data.)
	@docker-compose down -v --remove-orphans

restart: ## Stop and start containers
	$(info Make: Restarting "$(ENV)" environment containers.)
	@make -s stop
	@make -s start

push: ## Pushing image to hub
	$(info Make: Pushing "$(TAG)" tagged image.)
	@docker push $(IMAGE):$(TAG)

pull: ## Pulling image from hub
	$(info Make: Pulling "$(TAG)" tagged image.)
	@docker pull $(IMAGE):$(TAG)

clean: ## Remove unused data without prompt for confirmation
	@docker system prune --volumes --force

login: ## Login to Docker Hub.
	$(info Make: Login to Docker Hub.)
	@docker login -u $(DOCKER_USER) -p $(DOCKER_PASS)