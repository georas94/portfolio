# Expense report

## Usage

You need to have docker installed on your computer, and you will also need to update your virtual host.

Start by adding frais.local to your virtual host in order to keep the configuration working. If using a mac, the file can be found in 'etc/hosts'.

After completing the virtual host part, you can build and start the containers.
\
Run this command in your terminal
```bash
docker compose up -d
```
The '-d' flag to keep it running on the background.

\
After, you need to load dummy data into the database. We will use "Make".
To do this  run this command :  \
```bash
make fixtures
```
\
And you are now ready to go. Enter the link below in your favorite browser after turning on your containers :
```python
frais.local
```
\
\
For testing purposes you can connect with these users :\
\
email : user1@frais.com | password : pass1\
email : user3@frais.com | password : pass3\
email : user25@frais.com | password : pass25\
email : user32@frais.com | password : pass32\
\
The pattern is always the same, they just have different roles, check them


## Copyrights

Kérima Rania TAMBOURA  
Abdoul-Rashid TAMBOURA
