public class RetailerAgent {
    
    int stock[][] = new int[10][4]; //instance variable: stock database array
    
    public RetailerAgent() {
        productId(); //call productId function
        price(); //call price function
        stockLevels(); //call stockLevels function
        deliveryOption(); //call deliveryOption function
    }
    
    //randomly generate 10 numbers that represent products
    void productId() {
        int a = 0;
        boolean add = false;
        
        //loop through the stock array
        for (int i = 0; i < stock.length; i++) {
            add = false;
            while (add == false) {
                add = true;
                a = (int)((Math.random() * 20) + 1); //generate random number between 1 and 20
                
                //check if the number already exists in the stock array
                for (int j = 0; j < stock.length; j++) {
                    //if the number exists, the loop will restart
                    if (a == stock[j][0]) {
                        add = false;
                    }
                }
            }
            stock[i][0] = a; //add the value to the stock array
        }
    }
    
    //randomly generate an integer to represent the price of each item
    void price() {
        for (int i = 0; i < stock.length; i++) {
            stock[i][1] = (int)((Math.random() * 100) + 1); //generate random number between 1 and 100
        }
    }
    
    //randomly generate an integer to represent stock level available for each item
    void stockLevels() {
        for (int i = 0; i < stock.length; i++) {
            stock[i][2] = (int)((Math.random() * 10) + 1); //generate random number between 1 and 50
        }
    }
    
    //randomly generate integer to represent the delivery option available
    void deliveryOption() {
        for (int i = 0; i < stock.length; i++) {
            stock[i][3] = (int)(Math.random() * 4); //generate random number between 0 and 3
        }
    }
}