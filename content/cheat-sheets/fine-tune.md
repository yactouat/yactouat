---
cheat-sheet: 'fine tune'
subject: 'Machine learning'
---

## `fine_tune`

```python
learner = vision_learner(data_loader, resnet18, metrics=accuracy)
learner.fine_tune(1)
```

When you do transfer learning, you _fine-tune_ a pretrained model so that it performs better at a new task. `fine_tune` is a method in the `fastai` that first trains the randomly added layers on the new dataset for one epoch, then unfreezes all the layers of the model and trains it for the specified number of epochs.