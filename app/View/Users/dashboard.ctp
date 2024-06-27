<div class="container">
    <div class="message-list">
        <div class="card mb-3">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0 text-uppercase">Message List</h5>
            </div>
            <div class="card-body">
                <div class="text-right mb-3">
                    <?= $this->Html->link('New Message', ['controller' => 'messages', 'action' => 'new_message'], ['class' => 'btn btn-primary']) ?>
                </div>

                <div id="messages-container">
                  
                </div>

                <div id="no-messages" class="text-center" style="display: none;">
                        <p>No messages found.</p>
                </div>

                <div class="text-center">
                    <button id="show-more" class="btn btn-secondary">Show More</button>
                </div>               
            </div>
        </div>
    </div>
</div>


