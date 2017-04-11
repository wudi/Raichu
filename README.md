Raichu Specification
---

### Git分支规范

#### master分支
线上发布分支，保证完全的可用性，测试通过后可直接发布到线上环境

#### 其他分支
1. Feature新特性分支，基于master创建的分支，保证可用性，可提供测试环境进行测试，例如即将开发弹幕管理模块，可新增名为dm的分支，开发完成测试通过后请求合并到master分支，合并完成后可以删除此分支并上线
2. 个人分支，基于Feature分支创建的分支，用户个人本地开发，提供本地环境开发测试，当开发测试结束后，合并到原Features分支
3. Fix分支，基于master创建的分支，当特性已处于测试发布过程或者上线过程时，发现了bug，则创建此分支，建议分支名为fix_xxx，开发测试完成后，可发起merge_request请求合并到master分支，合并完成后可以删除此分支

### 开发新特性流程
1. 基于master分支，创建一个Feature分支，可进行一些新特性的初始化工作，例如构造入口、创建目录、结构命名等
2. 基于之前创建的Feature分支，本地创建新的分支，命名规范为开发者名字_Feature名，例如开发者A开发弹幕管理模块功能，则可命名为A_dm，用于本地的开发，当开发完成到某个阶段需要测试的时候，合并到原Feature分支
3. 当新特性开发提测完成后，发起merge_request请求到master，处于随时可上线状态

### 目录结构规范
1. app目录，应用目录，新增/修改类、修改目录结构，需要在项目的根目录执行composer dump -o
 * console 命令行工具、计划任务所在目录
 * controller 控制器，可按照业务划分子目录，文件名简化为业务名.php，类名Controller结尾，采取驼峰法命名，如IndexController
 * model 模型，按照业务划分子目录
 * view 视图目录，存放页面视图文件，布局视图模板放在layout目录，错误提示页面放在error目录，公共视图模板放在block目录，其他目录按照业务划分
 * library 库目录，存放一些公共的类以及方法，例如分页、错误码定义、数据过滤、图片上传、第三方调用等
 * middleware 中间件目录，放置一些公共的中间件处理，权限判断等
 * Bootstrap.php 启动器，自动加载，初始化数据库、路由、日志、错误处理

2. config目录，数据库为database.php，redis为redis.php，mc为memcache.php等
3. public目录，存放入口文件index.php以及静态资源文件
4. vendor目录，存放composer加载的包
5. tool文件为命令行工具入口文件，当实现了新的工具后需要在此文件注册才能使用


VUI本地安装流程
---
#### 1. 进入项目的public目录下
```
cd public
```

#### 2.安装nodejs
debain:
```
curl -sL https://deb.nodesource.com/setup_5.x | sudo -E bash -

sudo apt-get install -y nodejs
```

centos:
```
curl --silent --location https://rpm.nodesource.com/setup_5.x | bash -

yum -y install nodejs
```

#### 3.全局安装webpack
```
sudo npm install webpack -g
```

#### 4.安装npm依赖包（使用淘宝镜像）
```
cd public

sudo npm install --registry=https://registry.npm.taobao.org
```

#### webpack构建
```
webpack
```
#### 前端资源打包
```
npm run build
```

### 安装时可能需要的东西
```
sudo npm install webpack
npm cache clean
```

nginx配置注意 index.html index.php

获取前端性能监控数据
---
在控制台执行
```js
perf.printMeasures()
```
