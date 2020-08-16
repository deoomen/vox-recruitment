# vox-recruitment

Recruitment task for the VOX company.

## Stack

* PHP 7.4
* Bootstrap 4
* jQuery 3

## Install

1. Download and unpack ZIP or use `git clone`.

2. Run database scripts:

    1. `install/vox-recruitment.sql`
    2. `install/slides.sql`

3. Install dependencies:

    ```bash
    cd /path/to/www/vox-recruitment
    npm install
    gulp
    cd api
    composer install
    composer dumpautoload -o
    ```
