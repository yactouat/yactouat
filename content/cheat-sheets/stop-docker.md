---
cheat-sheet: 'Stop Docker'
subject: 'Docker'
---

```bash
docker stop $(docker ps -a -q)
```