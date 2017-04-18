#!/bin/bash
function main {
    echo -ne "[1/4] Downloading Composer Setup File..."\\r
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    cPrint "[1/4] Downloading Composer Setup File... Done" "green"
    echo -ne "[2/4] Verifying Setup File..."\\r
    hash=$(curl -L https://composer.github.io/installer.sig)
    fileStatus=$(php -r "if (hash_file('SHA384', 'composer-setup.php') === '$hash') { echo 'Verified'; } else { echo 'Corrupted'; unlink('composer-setup.php'); }")
    if [ $fileStatus = "Verified" ]; then
        cPrint "[2/4] Verifying Setup File... Verified" "green"
    else
        cPrint "Installer corrupted. Try again." "red"
    fi
    echo -ne "[3/4] Installing Composer..."\\r
    php composer-setup.php
    cPrint "[3/4] Installing Composer... Installed" "green"
    echo -ne "[4/4] Cleaning..."\\r
    php -r "unlink('composer-setup.php');"
    cPrint "[4/4] Cleaning... Done" "green"
}

function cPrint() {
    if [ $2 = "red" ]; then
        echo -e "\033[1;31m$1\033[0m"
    fi
    if [ $2 = "green" ]; then
        echo -e "\033[1;32m$1\033[0m"
    fi
}


if which php >/dev/null; then
    if which curl >/dev/null; then
        main
    else
        cPrint "Error: cURL Not Installed" "red"
    fi
else
    cPrint "Error: PHP Not Installed" "red"
fi