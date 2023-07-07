# domain-event-to-bus

This repository demonstrates some principles and patterns around handling a Request cycle, but executing code at the correct moment.

* `Controller`: The entrypoint of the application is the UserInterface layer, where controller callables receive the Request.

* `Command` pattern: Let the controller callables in the UserInterface layer create and dispatch a command based on the data in
the request. The `CommandBus` is responsible for dispatching the command, and in practice often is handled asynchronously by one or more
background processes in parallel.

* `Repository`: The repositories (typically implemented through an ORM like Doctrine) are responsible for interaction between the object
and the persistence layer. The repository interfaces on the domain layer are implemented by the infrastructure layer, and used by the
application layer. 

* `CommandHandler`: The command handlers in the application layer execute the application glueing logic, and perform the tasks that are
needed to call a domain method on a aggregate root entity from the Domain layer. The handler is responsible for triggering that the
repository flushes the changes of the aggregate root entities once all business logic was completed. 

* `AggregateRoot`: Representation of the most important entrypoint for state and methods to apply changes to it's own internal state. The
aggregate root is responsible for keeping track of contentful domain events that happened, but not responsible for informing others about
that domain event yet.

* `AggregateRootDomainEventDispatcher`: The class that during compilation of the framework gets injected with both the event bus and all
repository implementations. The dispatcher `afterFlush` method will be called by the framework once the repository flush was successful,
and will ask all the repositories for all instances of all aggregate roots. For all the aggregate roots the domain events will be retrieved
and the dispatcher will dispatch those domain events to the `EventBus`.

So the eventual outcome: by calling a controller, a domain event that something intentful happened will be published to the event bus, but
only when the domain business rules (strong, testable domain objects) and the database transaction were successful.
