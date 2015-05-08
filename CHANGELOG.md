Opendi Lang Changelog
=====================

0.3.6 (2015-05-08)
------------------

* Added `JsonWriter` class

0.3.5 (2015-02-02)
------------------

* Added `String::oneLiner()`
* Modified `String::mostSimilar()` to use `similar_text()` instead of
  `levenshtein()`
* Modified `String::translit()` to accept non-string scalars

0.3.4 (2014-11-07)
------------------

* Fixed CloneProperties trait to use late static binding which allows it to be
  used on a class and work on it's subclasses.
* Improved tests

0.3.3 (2014-09-25)
------------------

* Added `Json::load()` and `Json::dump()`
* Added `String::translit()`

0.3.2 (2014-07-21)
------------------

* Added `Json` helper class

0.3.1 (2014-07-14)
------------------

* Added special handling for german characters in `String::slugify()`

0.3.0 (2014-06-06)
------------------

Features:

* Added `String::slugify()`
* Moved to PSR4 for autoloading
* Moved to PSR2 code style
