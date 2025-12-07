# Git Cheatsheet

# Change Git Author for Commit
- git commit --amend --author="dontKnew <sajid.phpmaster@gmail.com>"
  
# SSH KEY SETUP on git bash window
	1. git config --global user.email "israfil123.sa@gmail.com" : set email
	2. git config --global user.name "Dont Knew" : set name
	3. open command prompt
		 - ssh-keygen -t ed25519 -C "israfil123.sa@gmail.com"
			or 
		- ssh-keygen -t rsa -b 4096 -C "your_email@example.com"  // for legay system
	4. cat ~/.ssh/id_ed25519.pub 
	5. get the key and paste into ur github account https://github.com/settings/ssh/new
	6. first push git@github.com:dontKnew/auth-providers.git ask for first time authentication
	7. Testing for SSH Connection
		1. ssh -vT git@github.com  #for debuging..
		2. ssh -T git@github.com #msg ur github username if connected to github account


## push to project in github
	1. git init : create git file 
	2. git add . : add all file and folders
	3. git add fileName.extension
	4. git commit -m "Your comment"
	5. git branch -M branchName : default branch is master or main 
	5. git remote add origin https://github.com/dontKnew/food-devliery.git
	6. git remote -v : verify for url where's you are pushing..
	7. git push -u push origin branchname 
		-  git push push origin branchname  : assume already setup

## Below Errors to solve with command : 	
	- fatal: refusing to merge unrelated histories : git pull origin master --allow-unrelated-histories

## Remove Specfic Folder after before commit	   
	  git add .
	  git reset foldername OR git add --all :!foldername

## Restore From Specific Comment : 
	I. git log : get the comment hash..id
	git checkout <commit_hash> -- path/to/deleted/file & 
	Latest : git checkout HEAD -- path/to/deleted/file	

## changed remote origin 
	 -  git remote set-url origin git@github.com:dontKnew/rapidexin.git

## before commit remove the files modification or back to last modification or discard modification : 
	- git reset --hard

## Git Branching & hide and show file/folder, 
	1. first create the branch and enter the branch 
	2. thereafter create file/folderd
	3. git add filename/folderName
	4. git commit "Your comment"
	4. now you will exits from branch, your file/folder will be invisible
	
##  Push All Branches together
	- git push --all origin

## fetch all branches together to local computer.
	- git pull --all

## remove the folder/file after git add and bofore commit from github trace  
	- git rm -r --cached path/filename 
 
