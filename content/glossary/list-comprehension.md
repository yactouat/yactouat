---
subject: 'Python'
term: 'list comprehension'
---

Python's list comprehension is a concise way to create a new list by performing an operation on each item in an existing list or iterable. It consists of an expression followed by a for clause, and optionally one or more if clauses. The expression is evaluated for each item in the iterable, and the results are collected into a new list. Here's an example:

```python
# create a list of squares of numbers from 0 to 9
squares = [x**2 for x in range(10)]
print(squares)  # [0, 1, 4, 9, 16, 25, 36, 49, 64, 81]
```

Here's another example with an `if` clause =>

```python
# create a list of even numbers from 0 to 9
evens = [x for x in range(10) if x % 2 == 0]
print(evens)  # [0, 2, 4, 6, 8]
```