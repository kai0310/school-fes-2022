# School-fes-2022

This repository was used by my school as an advance reservation system for the festival and as the official website for
the festival.
The code is entirely open source and licensed under the [MIT license](./LICENSE).
We welcome your contributions but we encourage you to read the contributing guide before creating an issue or
sending in a pull request. Read the installation guide below to get started with setting up the app on your machine.

## Requirements

- PHP ^8.1
- [Composer](https://getcomposer.org/download/)
- [NPM](https://docs.npmjs.com/downloading-and-installing-node-js-and-npm)

## Installation

1. Clone this repository with `git clone git@github.com:kai0310/school-fes-2022.git`
2. Run `composer install` to install the PHP dependencies
3. Set up a local database called laravel
4. Run `composer setup` to set up the application and build frontend server
5. Serve backend server (ex: `php artisan serve`)
6. Configure the (optional) features from below

### Google OAuth (optional)

This project allows users to log in using Google OAuth.
To use, enter your API key in the following environment variable.

```.env
GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
```

### School's own domain

You can specify your school's own domain.
This allows only school personnel to log in.
School personnel are automatically granted privileges.

```.env
SCHOOL_DOMAIN=
```

## Contributing

Thank you for considering contributing to this repository! The contribution guide can be found in
the [CONTRIBUTING.md](./CONTRIBUTING.md).

## Code of Conduct

In order to ensure that this repository community is welcoming to all, please review and abide by
the [Code of Conduct](./CODE_OF_CONDUCT.md).

## License

The school-fes-2022 is open-sourced software licensed under the [MIT license](./LICENSE).
