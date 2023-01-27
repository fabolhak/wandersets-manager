# WanderSets Manager

This is a very basic html, php and mysql app which can be used to track hicking gear in a group of persons. Currently, there is no mechanism to prevent any spam.

## Installation

Just put this into your webspace with php enabled and edit the mysql credentials and database.

Create the table:

```mysql
USE <database>
CREATE TABLE wl_set (id INTEGER PRIMARY KEY, holder VARCHAR(255));
```

## Add new Item

Login to your mysql database and issue the following command:

```mysql
USE <database>
INSERT INTO wl_set (id, holder) VALUES (42, 'foo');
```

Deleting is analogous (just look up the corresponding mysql command or ask ChatGPT).