## Setup heroku for upload json server...
1. Create Heroku account
2. install heroku in computer https://devcenter.heroku.com/articles/heroku-cli
3. command line	:
	3.1 heroku login -i
	3.2 heroku create projectName
	3.3 git project folder / json folder..
	3.4 git add .
	3.5 git commit -m "make it better" or git commit -am "make it better"
	3.6 git push heroku master done!


## Deploy Angular Project to github
1. Go to Angular Project
2. Angular automatic create .git file
	2.1 You have to create new repository in ur github account.
	2.2 Add origin by command : add origin to ur folder : git remote add origin https://github.com/<username>/<repositoryname>.git
3. Install this tool to ur current project by use this commmand : ng add angular-cli-ghpages
4. Lets Deploy Project to Github Live server  by using command : ng deploy --base-href=/<repositoryname>/ ng deploy --base-href=/failureboy1/
	or 4.1 ng deploy your-angular-project --base-href=/<repositoryname>/
5. Your Project is Now live on github page link : https://<username>.github.io/<repositoryname>.
