---
cheat-sheet: 'Git'
subject: 'Git'
---

## Having a main repo to sync to from a fork

- `git remote add upstream https://github.com/OWNER/REPO.git`
- `git fetch upstream`
- `git checkout main`
- `git merge upstream/main`
