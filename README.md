# IMT3851---Assignment-2
School Assignment at NTNU Gjøvik

Github: [https://github.com/OrangeeWeb/IMT3851---Assignment-2](https://github.com/OrangeeWeb/IMT3851---Assignment-2)

© Agne Ødegaard 2016 - 140699


## Todo:

- Vote
    - Edit vote
    - Prevent people from voting more then once
- Admin Panel
    - Delete User
    - Delete Post
    - Edit Category
    - Delete Category
- Profile Page
    - Edit info
    - Front Page Cookie thingy
- Setup.php


## Instructions

- Need to be run at root folder (localhost/ or something/).
- Go to Class/data/config.ini, Change database settings after your needs.
- Go to http://localhost/install


## Simple Documentation

### $app

    App Object (
        $app::$user
        $app::$page
    )
    
### $app::$user => logged inn user

    Account Object (
        [id:Account:private]      => int
        [name:Account:private]    => string
        [surname:Account:private] => string
        [mail:Account:private]    => string
        [rank:Account:private]    => int (0 - 4)
    )

### $app::$page => current page

    Page Object (
        [url:Page:private] => string (/something)
        [title:Page:private] => string
        [content:Page:private] => PHP page
        [header:Page:private] => Profile
        [visible:Page:private] => bool
        [icon:Page:private] => Font Awesome Icon Name
        [right:Page:private] => bool
        [hasMore:Page:private] => nothing
        [get:Page:private] => $_GET names
    )


## $news Methods:

    $news->get_first();
    $news->get_first();
    
### You can also:

    count($news)
    foreach($news as $permalink => $NewsObject){}
    
## $NewsObject

    NewsPage Object (
        [id:NewsPage:private] => int
        [title:NewsPage:private] => String
        [article:NewsPage:private] => Markdown Text
        [preview:NewsPage:private] => text
        [authorUUID:NewsPage:private] => int
        [author:NewsPage:private] => string
        [image:NewsPage:private] => string
        [style:NewsPage:private] => int
        [timestamp:NewsPage:private] => timestamp
        [votes:NewsPage:private] => Array
            (
                [up] => int
                [down] => int
                [total] => int
                [percent] => int
            )
        [cat] => string
        [catID] => int
    )


## Photos

![Image of the project](http://i.imgur.com/8wb51lh.png)

![Image of the project](http://i.imgur.com/tVIOEWy.png)

![Image of the project](http://i.imgur.com/HMz7Jl8.png)
