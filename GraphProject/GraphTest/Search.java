import java.util.LinkedList;

public class Search {

  private static final String START = "A";
  private static final String END = "B";

  public static void main(String[] args) {
    // this graph is directional
    Graph graph = new Graph();
    /* Original Graph
    graph.addEdge("A", "B");
    graph.addEdge("A", "C");
    graph.addEdge("B", "A");
    graph.addEdge("B", "D");
    graph.addEdge("B", "E"); // this is the only one-way connection
    graph.addEdge("B", "F");
    graph.addEdge("C", "A");
    graph.addEdge("C", "E");
    graph.addEdge("C", "F");
    graph.addEdge("D", "B");
    graph.addEdge("E", "C");
    graph.addEdge("E", "F");
    graph.addEdge("F", "B");
    graph.addEdge("F", "C");
    graph.addEdge("F", "E");
    */
    graph.addEdge("A", "C");
    graph.addEdge("C", "A");

    graph.addEdge("C", "F");
    graph.addEdge("F", "C");
    graph.addEdge("B", "F");
    graph.addEdge("F", "B");
    graph.addEdge("C", "G");
    graph.addEdge("G", "C");
    
    graph.addEdge("D", "G");
    graph.addEdge("G", "D");
    
    graph.addEdge("A", "D");
    graph.addEdge("D", "A");
    
    graph.addEdge("D", "H");
    graph.addEdge("H", "D");
    
    graph.addEdge("E", "H");
    graph.addEdge("H", "E");

    LinkedList<String> visited = new LinkedList();
    visited.add(START);
    new Search().breadthFirst(graph, visited);
  }

  private void breadthFirst(Graph graph, LinkedList<String> visited) {
    LinkedList<String> nodes = graph.adjacentNodes(visited.getLast());
    System.out.print(visited.getLast() + "s adjacent : " );
    for(String node : nodes){
      System.out.print(node);
    }
    System.out.println();
    // examine adjacent nodes
    for (String node : nodes) {
      if (visited.contains(node)) {
        continue;
      }
      if (node.equals(END)) {
        visited.add(node);
        printPath(visited);
        visited.removeLast();
        break;
      }
    }
    // in breadth-first, recursion needs to come after visiting adjacent nodes
    for (String node : nodes) {
      if (visited.contains(node) || node.equals(END)) {
        continue;
      }
      visited.addLast(node);
      breadthFirst(graph, visited);
      visited.removeLast();
    }
  }

  private void printPath(LinkedList<String> visited) {
    for (String node : visited) {
      System.out.print(node);
      System.out.print(" ");
    }
    System.out.println();
  }
}
