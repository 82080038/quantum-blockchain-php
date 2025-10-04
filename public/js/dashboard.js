$(document).ready(function() {
    // Update current time every second
    function updateTime() {
        const now = new Date();
        const timeString = now.toLocaleString('en-US', {
            year: 'numeric',
            month: '2-digit',
            day: '2-digit',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        });
        $('#currentTime').text(timeString);
    }
    
    // Update time immediately and then every second
    updateTime();
    setInterval(updateTime, 1000);
    
    // Trading controls
    let isTrading = false;
    
    $('#startTrading').click(function() {
        if (!isTrading) {
            isTrading = true;
            $(this).prop('disabled', true);
            $('#stopTrading').prop('disabled', false);
            
            // Add activity log
            addActivityLog('Trading started', 'success');
            
            // Simulate trading updates
            startTradingSimulation();
        }
    });
    
    $('#stopTrading').click(function() {
        if (isTrading) {
            isTrading = false;
            $(this).prop('disabled', true);
            $('#startTrading').prop('disabled', false);
            
            // Add activity log
            addActivityLog('Trading stopped', 'warning');
        }
    });
    
    function startTradingSimulation() {
        if (!isTrading) return;
        
        // Simulate portfolio value changes
        const currentValue = parseFloat($('#portfolioValue').text().replace(/,/g, ''));
        const change = (Math.random() - 0.5) * 100; // Random change between -50 and +50
        const newValue = currentValue + change;
        
        $('#portfolioValue').text(newValue.toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }));
        
        // Simulate P&L changes
        const currentPnl = parseFloat($('#unrealizedPnl').text().replace(/,/g, ''));
        const pnlChange = (Math.random() - 0.5) * 50; // Random change between -25 and +25
        const newPnl = currentPnl + pnlChange;
        
        $('#unrealizedPnl').text(newPnl.toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }));
        
        // Continue simulation if trading is still active
        setTimeout(startTradingSimulation, 2000);
    }
    
    function addActivityLog(message, type = 'info') {
        const time = new Date().toLocaleTimeString();
        const activityItem = $(`
            <div class="activity-item">
                <span class="activity-time">${time}</span>
                <span class="activity-message activity-${type}">${message}</span>
            </div>
        `);
        
        $('#activityList').prepend(activityItem);
        
        // Keep only last 10 activities
        $('#activityList .activity-item').slice(10).remove();
    }
    
    // Initialize activity log
    addActivityLog('System initialized successfully', 'success');
});