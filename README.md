# Singleton Db Instance
The anatomy of a singleton db pattern

1) A private constructor is used to prevent the direct creation of objects from the class.

2) The expensive process is performed within the private constructor.

3) The only way to create an instance from the class is by using a static method that creates the object only if it wasn't already created.
