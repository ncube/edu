#!/bin/bash
if which composer >/dev/null; then
    cmd="composer"
else
    if [ -f ./composer.phar ]; then
        # TODO: Check if Php is Installed
        cmd="php composer.phar"
    else
        cmd="php composer.phar"
        echo "Composer is not installed. Do you want to install composer [Y/N]"
        while true; do
            read -p "Do you wish to install this program? [Y/N]" yn
            case $yn in
                [Yy]* ) ./install-composer.sh; break;;
                [Nn]* ) exit;;
                * ) echo "Please answer yes or no.";;
            esac
        done
    fi
fi

# TODO: Check if ncube-db is up

# Install Packages
$cmd install

# Take Iterations Input
function getInt() {
    re='^[0-9]+$'
    while true; do
        read -p "No of $1: " input
        if ! [[ $input =~ $re ]]; then
            echo "Enter Valid Iterations"
        else
            break;
        fi
    done
}

getInt "Users"
users=$input
getInt "Follows"
follows=$input
getInt "Questions"
questions=$input
getInt "Answers"
answers=$input
getInt "Messages"
messages=$input

echo "Users: $users"
echo "Follows: $follows"
echo "Questions: $questions"
echo "Answers: $answers"
echo "Messages: $messages"

# Run Seeder
echo "Seeding..."
php seed.php $users $follows $questions $answers $messages

# Exit
exit
