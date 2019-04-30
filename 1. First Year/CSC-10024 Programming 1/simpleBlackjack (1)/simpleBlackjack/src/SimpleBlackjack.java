
import java.io.IOException;
import java.util.logging.Level;
import java.util.logging.Logger;

public class SimpleBlackjack
{
    // Integer arrays to contain each of the players' drawn card values.
    static Card[] computerCards = new Card[12];  
    static Card[] userCards = new Card[12];
    
    static int computerCardsCount = 0;
    static int userCardsCount = 0;
    
    // Create a new deck of cards.
    static Deck deck = new Deck();

    // Variables to keep the score of each player.
    static int computerSum;
    static int userSum;
    
    public static void main(String[] args)
    {
        // Deal two cards to each player.
        computerCards[0] = deck.drawCard();
        computerCards[1] = deck.drawCard(); 
        computerCardsCount = 2;
        userCards[0] = deck.drawCard();
        userCards[1] = deck.drawCard();
        userCardsCount = 2;
        
        // Variables to keep the score of each player.
        computerSum = computerCards[0].value + computerCards[1].value;
        userSum = userCards[0].value + userCards[1].value;

        displayCards(false);  // Display the cards with one of the Computer's hidden from the User.
        
        
        // Construction site...
        
        //import isr and br
        java.io.InputStreamReader isr = new java.io.InputStreamReader(System.in);
        java.io.BufferedReader br = new java.io.BufferedReader(isr);
        
        //declare variables
        boolean drawCard = true;
        boolean validInput = true;
        String input = null;
        
        System.out.println("\nUSER'S TURN:");
        
        //USER TURN
        do
        {
            do
            {
                System.out.print("Draw new card? (Y/N): ");
                //USER INPUT VALIDATION
                try {
                    input = br.readLine();
                    input = input.toLowerCase();
                    validInput = true;
                } catch (IOException e) {
                    validInput = false;
                    System.out.println("Invalid Input");
                }
                
                if ((input.equals("y") || input.equals("n")))
                {
                    validInput = true;
                } else {
                    validInput = false;
                    System.out.println("Invalid selection");
                }
            } while (!validInput);
            
            if (input.equals("y"))
            {
                userCardsCount++;
                userCards[userCardsCount-1] = deck.drawCard();
                userSum = userSum + userCards[userCardsCount-1].value;

                System.out.println("User drew: " + userCards[userCardsCount-1].name);
                displayCards(false);
            } else {
                drawCard = false;
                System.out.println("User decides to hold");
            }
            
        } while ((drawCard) && (userCardsCount < userCards.length) && (userSum < 21));
        
        //COMPUTER'S TURN
        if (userSum <= 21)
        {
            do
            {
                System.out.println("\nCOMPUTER'S TURN:");
                computerCardsCount++;
                computerCards[computerCardsCount-1] = deck.drawCard();
                computerSum = computerSum + computerCards[computerCardsCount-1].value;

                System.out.println("Computer drew: " + computerCards[computerCardsCount-1].name);
                displayCards(true);

            } while ((computerCardsCount < computerCards.length) && (computerSum < 21) && (computerSum < userSum)); //COMPUTER STRATEGY
            if (computerSum <= 21)
            {
                System.out.println("Computer decides to hold");
            }
        }
        
        //GAME ENDING
        System.out.println("\nEND:");
        displayCards(true);
        
        if (userSum > 21)
        {
            System.out.println("User went over 21. COMPUTER WINS!");
        } else if (computerSum > 21)
        {
            System.out.println("Computer went over 21. USER WINS!");
        } else if (userSum > computerSum)
        {
            System.out.println("USER WINS!");
        } else {
            System.out.println("COMPUTER WINS!");
        }
    }
    
    
    public static void displayCards(boolean showHidden)
    {
        if(showHidden) {
            System.out.print("Computer's cards: [" + computerCards[0].name + "]");
        } else {
            System.out.print("Computer's cards: [X]");
        }
        for(int i = 1; i < computerCardsCount; i++) {
            System.out.print("[" + computerCards[i].name + "]");
        }
        if(showHidden) {
            System.out.print(" (sum: " + computerSum + ")");
        }
        
        System.out.print("\nUser's cards: ");
        for(int i = 0; i < userCardsCount; i++) {
            System.out.print("[" + userCards[i].name + "]");
        }
        System.out.print(" (sum: " + userSum + ")");

        System.out.print("\n");
    }
}
