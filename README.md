Installation

1. composer require pitech/guard-security-bundle
2. In security.yml:
    firewalls:
        # disables authentication for assets and the profiler, adapt it according to your needs
        dev:
            pattern: ^/(_(profiler|wdt)|css|images|js)/
            security: false

        main:
            guard:
                authenticators:
                    - pitech_security.token_authenticator
            stateless: true

