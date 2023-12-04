---
cheat-sheet: 'SSH'
subject: 'SSH'
---

## bootstrap agent and load an identity

- `eval "$(ssh-agent -s)"`
- `chmod 0600 PATH_TO_PRIVATE_KEY` (key should not be readable by others)
- `ssh-add PATH_TO_PRIVATE_KEY`
