Document of Raichu
---

### 目录结构规范
1. app目录，应用目录，新增/修改类、修改目录结构，需要在项目的根目录执行composer dump -o
 * config           全局配置层(数据库为database.php，常量defined.php，自动装载config.php)
 * console          命令行工具、计划任务所在目录
 * engine           核心库目录，存放一些公共的类以及方法，例如控制器, 模型, 视图, Restful风格路由, 分发器, 装载器, 中间件等
 * middleware       中间件目录，放置一些公共的中间件处理，权限判断等
 * modules          项目模块分组层(hello => controller/model/provider)
 * provider         库目录，存放一些公共的类以及方法，例如异步处理、日志记录, 绘画控制、第三方调用等
 * Bootstrap.php    启动器，自动加载，初始化数据库、路由、日志、错误处理

2. public目录，存放入口文件index.php以及静态资源文件
3. vendor目录，存放composer加载的包
4. tool文件为命令行工具入口文件，当实现了新的工具后需要在此文件注册才能使用
5. 待整理 ...