<?php
namespace MyApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);

        echo "New connection! ({$conn->resourceId})\n";

        foreach ($this->clients as $client) {
            $client->send("Server: ({$conn->resourceId}) Joined");
        }
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $numRecv = count($this->clients) - 1;
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');

        foreach ($this->clients as $client) {
            if (strlen($msg) >= 500) {
                if ($from == $client) {
                    $client->send("Server: Message was rejected because it was long!");
                }
            } else
            if ($from !== $client) {
                // The sender is not the receiver, send to each client connected
                if ($msg != "KeepAlive_Ahdie73") {
		    $test = date('Y-m-d H:i:s', time());
                    $client->send("<{$test}> ({$from->resourceId}): " . htmlspecialchars($msg));
                }
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
        foreach ($this->clients as $client) {
            $client->send("Server: ({$conn->resourceId}) Left");
        }
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}
