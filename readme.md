# WebForMyself project

### Training sets:

#### Chapter #1: Creating a framework from scratch

* [1.04.ErrorHandler](../../archive/refs/heads/1.04.ErrorHandler.zip)
* [1.05.Router](../../archive/refs/heads/1.05.Router.zip)
* [1.09.Controller.View](../../archive/refs/heads/1.09.Controller.View.zip)
* [1.12.Model](../../archive/refs/heads/1.12.Model.zip)

#### Chapter #2: Developing the frontend for an e-commerce CMS

* [2.04.Multilanguage](../../archive/refs/heads/2.04.Multilanguage.zip)
* [2.11.Cache.Menu](../../archive/refs/heads/2.11.Cache.Menu.zip)
* [2.12.Cart](../../archive/refs/heads/2.12.Cart.zip)
* [2.19.Breadcrumbs](../../archive/refs/heads/2.19.Breadcrumbs.zip)
* [2.21.Categories](../../archive/refs/heads/2.21.Categories.zip)
* [2.25.Search](../../archive/refs/heads/2.25.Search.zip)
* [2.26.Wishlist](../../archive/refs/heads/2.26.Wishlist.zip)
* [2.29.Additional.pages](../../archive/refs/heads/2.29.Additional.pages.zip)
* [2.31.Signup.Signin](../../archive/refs/heads/2.31.Signup.Signin.zip)
* [2.35.Checkout](../../archive/refs/heads/2.35.Checkout.zip)
* [2.39.Cabinet](../../archive/refs/heads/2.39.Cabinet.zip)

#### Chapter #3: Developing the admin panel for an e-commerce CMS

* [3.02.Admin.access.control](../../archive/refs/heads/3.02.Admin.access.control.zip)
* [3.03.Dashboard](../../archive/refs/heads/3.03.Dashboard.zip)
* [3.04.Managе.Categories](../../archive/refs/heads/3.04.Managе.Categories.zip) > **Update stack required** [Learn more...](../../tree/3.04.Managе.Categories)
* [3.11.Manage.Products](../../archive/refs/heads/3.11.Manage.Products.zip)
* [3.17.Manage.Downloads](../../archive/refs/heads/3.17.Manage.Downloads.zip)
* [3.20.Manage.Orders](../../archive/refs/heads/3.20.Manage.Orders.zip)
* [3.22.Manage.Users](../../archive/refs/heads/3.22.Manage.Users.zip)
* [3.27.Manage.Pages](../../archive/refs/heads/3.27.Manage.Pages.zip)

***
### Download the Training Set
Choose and download the `*.zip` training set.

### Run the Training Set

|#| Terminal Command | Description |
| - | - | - |
|1. | `unzip *.zip` | Extract the downloaded `*.zip` archive |
|2. | `cd */` | Navigate to the root folder of extracted archive |
|3. | `cp .env.example .env` | Create a new `.env` file from `.env.example` |
|4. | `unzip .git.zip -d .git` | Extract `.git.zip` into the `.git` folder |
|5. | `make up` or <br> `make build` && `make up` | Start Docker Compose services <br>`make up` = `docker compose up -d`<br>`make build` = `docker compose build` |
|6. | `make cupdate` | Update PHP (Compoer) dependencies<br>Equivalent to: `docker exec php-fpm composer update --with-all-dependencies` |
|7. | `http://localhost:80` | Access the application<br>Adminer available at `http://localhost:8080` |

### Using the Training Set

#### Git Branches
The repository includes two branches:
* `master` (or similar): Contains the completed solution
* `try01` (or similar): Contains the unsolved task in initial state

Commands:
- List branches: `git branch`
- Switch branches: `git checkout <branch_name>`

#### Patch File (*.diff)
The root folder contains a `*.diff` file with all required changes to solve the task.
