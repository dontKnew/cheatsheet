# Git Cheatsheet
---
## Table of Contents
1. [First-Time Setup](firsttime-setup-one-time-only)
2. [SSH Key Setup](#ssh-key-setup)
3. [Project to Github ](#project-to-github)
4. [Daily Workflow (what you run every day)](#daily-workflow-what-you-run-every-day)
5. [Branches (feature work safely)](#branches-feature-work-safely)
6. [Merge & Conflicts (how to fix)](#merge--conflicts-how-to-fix)
7. [Tags & Versions (releases)](#tags--versions-releases)
8. [Hotfix from a Tag (fix old version)](#hotfix-from-a-tag-fix-old-version)
9. [Undo Changes (restore/reset)](#undo-changes-restorereset)
10. [Files & .gitignore](#files--gitignore)
11. [Remote URL & Multiple PCs](#remote-url--multiple-pcs)
12. [Useful Logs & Search](#useful-logs--search)
13. [Common Errors & Fixes](#common-errors--fixes)

---

## First Time Setup
Set your identity (used in commits):
```bash
git config --global user.name "Your Name"
git config --global user.email "you@example.com"
git config --global init.defaultBranch main # set the default branch name
git config --global --add safe.directory /home/website/htdocs  # set safe directory to use directy in git
```
Check Information Identity or Global Config
```bash
git config --global --list
#output
safe.directory=/home/gbs/htdocs
user.email=israfil123.sa@gmail.com
user.name=Dont Knew
init.defaultbranch=main
```
Change username for current project only
```bash
git config user.name "Project Name"
git config user.email "project@example.com"
```
Change author of last commit:
```bash
git commit --amend --author="Your Name <you@example.com>"
```

---

## SSH Key Setup
1. Generate key:
```bash
ssh-keygen -t ed25519 -C "you@example.com"
```
(press Enter for defaults) 2. Show public key:
```bash
cat ~/.ssh/id_ed25519.pub
```
3. Copy output → GitHub → Settings → SSH and GPG keys → New SSH key
4. Test connectivity with github success or failed
```bash
ssh -T git@github.com
```
---

## Push Project to Github
Inside project folder:
```bash
git init
git ls-files --others --exclude-standard | xargs du -ch # Linxu:check the size of untracked files and folder or before commit
git add .
git commit -m "initial commit"
```
Connect to GitHub repo:
```bash
git branch -M main
git remote add origin git@github.com:USERNAME/REPO.git
git remote -v
```
First push:
```bash
git push -u origin main
```
Change Remote Url:
```bash
git remote set-url origin git@github.com:USERNAME/REPO.git
```
---

## 4) Daily Workflow (use this every day)
Check status: check new commits or modify files
```bash
git status
```
See changes: check old file or new files difference of changes
```bash
git diff
```
Pull updates (second computer / fresh clone):
```bash
git pull origin <branchName>
```
---

## 5) Branches (feature work safely)
Create a feature branch & checkout:
```bash
git checkout -b feature-login
```
Push a branch to GitHub:
```bash
git push origin feature-login
```
Switch Branch  & commit ususal
```bash
git checkout main
```
Merge feature-login Branch into main branch:
```bash
git checkout main # swtich first main branch
git merge feature-login # operate to merge branch
git branch -d feature-login # delete the branch

Note : best practice delete the branch  after merge, if you have issue or bugs in feature-login branch, then create new branch feature-login-bugs namedly, then fix it
```
---

## 6) Merge & Conflicts (how to fix)
Conflict happens when the same lines changed in both branches. Git shows markers in file:
```
<<<<<<< HEAD
your code
=======
other code
>>>>>>> feature-branch
```
Steps to fix:
1. Edit file → keep correct code
2. Remove markers
3. Save
4. Run:

```bash
git add .
git commit
```
Tip: preview differences before merge:
```bash
git diff main feature-login
```
---

## 7) Tags & Versions (releases)
Use Semantic Versioning: `MAJOR.MINOR.PATCH`
* Patch (1.0.1): bug fix
* Minor (1.1.0): new feature
* Major (2.0.0): breaking change
* 
Create annotated tag:
```bash
git tag -a v1.0.0 -m "Initial release" # create tags
git push origin v1.0.0 # push tags to remote github
git push --tags # push all tags
git tag # list of all tags
```
Branch vs Tag:
* Branch = moving development
* Tag = frozen release snapshot
---

## 8) Hotfix from a Tag (fix old version)
Create branch from tag:
```bash
git checkout -b hotfix-v1.0 v1.0.0
```
Fix bug → commit → new tag:
```bash
git add .
git commit -m "fix: crash on login"
git tag -a v1.0.1 -m "Bug fix"
```
Push:
```bash
git push origin hotfix-v1.0
git push origin v1.0.1
```

Also merge fix into main:
```bash
git checkout main
git merge hotfix-v1.0
git push
```

---
## Undo Changes (restore/reset)
### Unstaged changes : edited but not/before `git add `.
```bash
git restore . # restore all changes that we have made in projects
git restore <fileName> # sepcific files, that we want to discard the changes
```

### Remove from Staging : after `git add`
```bash
git restore --staged .
```
### Undo last commit but keep code:
```bash
git reset --soft HEAD~1
```
### Undo last commit and unstage:
```bash
git reset --mixed HEAD~1
```
### Dangerous: delete commits + code:
```bash
git reset --hard HEAD~1
```
### View Old Version Code via commit_id
```bash
git checkout <commit_id>
```
---

## Files & .gitignore
### Important Poins
- if slash added in start : then its apply only root folder instead of ignore recursive, if found in node_modules in subfolder, then it will not ignore..
```
# Root Folder Ignore
/node_modules
/.env
/config.php
```
- Folder Ignore
```
/node_modules/  # root folder ignore with only folder
vendor/ # recursive ignore with only folder 
/logs # root file/folder ignore with same name

```
- File Type Ignore 
```
*.log # root and recursive ignore 
*.cache # root and recursive ignore
/*.log # root only ignore
```
- Exception Rule (!)  : ignore one folder & keep one file from that folder
```
logs/* # recursive ignore folder of files 
!logs/.gitkeep #logs folder all files ignore hoga lekin .gitkeep track hoga.
```

- SubFolder Ignore
```
/src/cache/ # ignore cache folder with from root folder
src/cache/ # ignore cache folder with recursive src/cache found anywhere in project
```
- Write Comments 
```
#this is my node_modules folder
node_modules
```
- multiple .gitignore files # git will combine the all .gitignore and create one rules, if parent fodler ignore folder "src" and subfolder keep the src folder, then it will overrite by the parent .gitignore
- Remove tracked file but keep locally:
```bash
git rm -r --cached path/file
```
---

## Change Project Git Url & Clone Git Project
```bash
git remote -v # check url
git remote set-url origin git@github.com:USERNAME/REPO.git #chnage git url in project
git clone git@github.com:USERNAME/REPO.git # clone the project new from github
```

## 12) Useful Logs & Search
Short history:
```bash
git log --oneline --graph --decorate
```
See who changed a line:
```bash
git blame filename
```
Show a commit:
```bash
git show <commit_id>
```

---
## 13) Common Errors & Fixes
**Refusing to merge unrelated histories**
```bash
git pull origin main --allow-unrelated-histories
```

**Forgot to push tags**
```bash
git push --tags
```

**Accidentally added secrets (.env)**
1. Add to .gitignore
2. Remove from tracking:
```bash
git rm --cached .env
git commit -m "remove .env from repo"
```

---

### Safe Rules to Remember

* Commit small and often
* Never force push to shared history unless you understand it
* Avoid `git reset --hard` unless you accept data loss
* After hotfix, always merge into main

End of cheatsheet.
