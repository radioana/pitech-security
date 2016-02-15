Installation

1. composer require pitech/guard-security-bundle
2. In security.yml:
        main:
            guard:
                authenticators:
                    - pitech_security.token_authenticator
            stateless: true

